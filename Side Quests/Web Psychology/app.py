from flask import Flask, render_template, request, redirect, url_for, flash, session
from flask_mysqldb import MySQL
from flask_bcrypt import Bcrypt
from werkzeug.security import generate_password_hash, check_password_hash

app = Flask(__name__)
app.secret_key = 'studentaffairs'
bcrypt = Bcrypt(app)

app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'pyscho-web'

mysql = MySQL(app)

# Sample data: Replace these with your actual questions
questions = [
    "What is your favorite color?",
    "What is your favorite animal?",
    "What is your favorite food?",
    "What is your favorite hobby?",
    "What is your favorite sport?",
    "Do you prefer tea or coffee?",
    "Do you enjoy reading books?",
    "Do you like to travel?",
    "Are you a morning person?",
    "Do you play any instruments?",
    "Do you prefer summer or winter?",
    "Do you like watching movies?",
    "Do you prefer cats or dogs?",
    "Do you exercise regularly?",
    "Are you a fan of video games?",
    "Do you like cooking?",
    "Do you enjoy gardening?",
    "Do you enjoy painting or drawing?",
    "Do you listen to music every day?",
    "Do you enjoy puzzles?"
]

# Calculate the total number of pages (5 questions per page)
QUESTIONS_PER_PAGE = 5
total_pages = (len(questions) + QUESTIONS_PER_PAGE - 1) // QUESTIONS_PER_PAGE

# Login route
@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']

        cursor = mysql.connection.cursor()
        cursor.execute("SELECT * FROM users WHERE username = %s", (username,))
        user = cursor.fetchone()
        cursor.close()

        if user and bcrypt.check_password_hash(user[2], password):
            session['user_id'] = user[0]
            session['username'] = user[1]
            session['role'] = user[4]
            return redirect(url_for('index'))
        else:
            error = "Invalid username or password."
            return render_template('login.html', error=error)

    return render_template('login.html')



# Signup route
@app.route('/signup', methods=['GET', 'POST'])
def signup():
    if request.method == 'POST':
        username = request.form['username']
        email = request.form['email']
        password = bcrypt.generate_password_hash(request.form['password'])
        role = 'user'  # Default role for new users

        cursor = mysql.connection.cursor()
        cursor.execute("INSERT INTO users (username, password, email, role) VALUES (%s, %s, %s, %s)", 
                       (username, password, email, role))
        mysql.connection.commit()
        cursor.close()
        
        flash('Signup successful! You can now log in.', 'success')
        return redirect(url_for('login'))
    return render_template('signup.html')

# Logout route
@app.route('/logout')
def logout():
    session.pop('user_id', None)
    session.pop('username', None)
    session.pop('role', None)
    flash('You have been logged out.', 'info')
    return redirect(url_for('index'))

# Admin route to view results
@app.route('/admin')
def admin():
    if 'user_id' not in session or session.get('role') != 'admin':
        flash('Access denied! Admins only.', 'danger')
        return redirect(url_for('login'))

    cursor = mysql.connection.cursor()
    cursor.execute("SELECT * FROM results")  # Adjust table name as necessary
    results = cursor.fetchall()
    cursor.close()
    return render_template('admin.html', results=results)

# Index route
@app.route('/')
def index():
    return render_template('index.html')

# Display questions for quiz
@app.route('/questions', methods=['GET', 'POST'])
def show_questions():
    if 'user_id' not in session:
        flash('Please log in to take the quiz.', 'warning')
        return redirect(url_for('login'))
    
    page = request.args.get('page', 1, type=int)  # Get the current page number (default is 1)
    
    # Determine the start and end indices for the questions to display
    start = (page - 1) * QUESTIONS_PER_PAGE
    end = start + QUESTIONS_PER_PAGE
    page_questions = questions[start:end]

    if request.method == 'POST':
        answers = [request.form.get(f"question_{i}") for i in range(start, end)]

        if page < total_pages:
            return redirect(url_for('show_questions', page=page + 1))
        else:
            return redirect(url_for('show_result', result="Good"))

    return render_template('questions.html', questions=page_questions, page=page, total_pages=total_pages, enumerate=enumerate)

# Display result after completing quiz
@app.route('/result')
def show_result():
    user_result = "Good"  # Replace with actual logic to determine the result
    
    # Insert result into the database
    cursor = mysql.connection.cursor()
    cursor.execute("INSERT INTO results (user_id, result) VALUES (%s, %s)", (session.get('user_id'), user_result))
    mysql.connection.commit()
    cursor.close()

    return render_template('results.html', result=user_result)

if __name__ == '__main__':
    app.run(debug=True)

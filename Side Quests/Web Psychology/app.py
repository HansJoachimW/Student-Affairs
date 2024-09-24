from flask import Flask, render_template, request, redirect, url_for

app = Flask(__name__)

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

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/questions', methods=['GET', 'POST'])
def show_questions():
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

@app.route('/result')
def show_result():
    result = request.args.get('result', 'Neutral')
    return render_template('result.html', result=result)

if __name__ == '__main__':
    app.run(debug=True)

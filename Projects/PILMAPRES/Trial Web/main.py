import pandas as pd
from flask import Flask, render_template, request

app = Flask(__name__)

file_path=r'.\\Projects\\PILMAPRES\\Trial Web\\rubric\\rubric.xlsx'
rubric_data = pd.read_excel(file_path, sheet_name='pilmapres')

# Extract unique placements for the status dropdown
unique_placements = rubric_data['Placement'].unique().tolist()
unique_levels = rubric_data['Category'].unique().tolist()

# Read the grading rubric from the Excel file
def load_rubrics(file_path, sheet_name):
    df = pd.read_excel(file_path, sheet_name)
    
    rubrics = {}
    
    # Iterate through each unique rubric identifier in the relevant column
    for rubric in df['Placement'].unique():  # Replace 'Placement' with the appropriate column name
        rubric_df = df[df['Placement'] == rubric]
        
        # Create a list of dictionaries for each rubric's criteria
        criteria_list = rubric_df.to_dict('records')
        
        # Add the rubric to the dictionary, using the rubric identifier as the key
        rubrics[rubric] = criteria_list

    return rubrics

# Load the rubrics into a dictionary
rubrics = load_rubrics(file_path, 'simkatmawa')

@app.route('/')
def index():
    return render_template('index.html', 
                           unique_placements=unique_placements,
                           unique_levels=unique_levels)

@app.route('/grading', methods=['GET', 'POST'])
def grading():
    if request.method == 'POST':
        selected_field = request.form.get('rubric')
        selected_rubric_data = rubrics.get(selected_field)  # No default value
        total_score = None

        print("Selected rubric:", selected_field)  # Debug line

        if selected_rubric_data:
            return render_template('grading.html', rubric=selected_rubric_data, selected_rubric=selected_field)
        else:
            print("No rubric found for the selected field.")  # Debug line
            return render_template('grading.html', rubric=[], selected_rubric=selected_field)

    return render_template('index.html')

@app.route('/submit', methods=['POST'])
def submit():
    # Get the form data
    nis = request.form['nis']
    name = request.form['name']
    major = request.form['major']
    status = request.form['status']
    level = request.form['level']
    participant_as = request.form['participant_as']
    
    criteria = f"{status}|{level}|{participant_as}"
    display_criteria = f"{status}, {level}, {participant_as}"

    # Look up the score from the rubric data
    score_row = rubric_data[rubric_data['Criteria'] == criteria]
    if not score_row.empty:
        score = score_row['Score'].values[0]  # Get the score
    else:
        score = 0   # Replace with actual score calculation logic

    # Render a new template to display the results
    return render_template('submit.html', nis=nis, name=name, major=major, criteria=criteria, display_criteria=display_criteria, score=score)


if __name__ == '__main__':
    app.run(debug=True)

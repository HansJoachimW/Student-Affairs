import pandas as pd
from flask import Flask, render_template, request, jsonify

app = Flask(__name__)

file_path = r'.\\Projects\\PILMAPRES\\Trial Web\\rubric\\rubric.xlsx'

# Load rubric data from Excel sheets into a dictionary
def load_rubrics(file_path, sheet_name):
    df = pd.read_excel(file_path, sheet_name)
    return df.to_dict('records')

# Load rubrics for both sheets
rubrics = {
    'PILMAPRES': load_rubrics(file_path, 'pilmapres'),
    'SIMKATMAWA': load_rubrics(file_path, 'simkatmawa')
}

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/individual-form')
def individual_form():
    return render_template('form_individual.html')  # Update as necessary

@app.route('/file-upload')
def file_upload():
    return render_template('form_batch.html')  # File upload page template


@app.route('/grading', methods=['GET', 'POST'])
def grading():
    if request.method == 'POST':
        selected_field = request.form.get('rubric')
        selected_rubric_data = rubrics.get(selected_field, [])

        return render_template('grading.html', rubric=selected_rubric_data, selected_rubric=selected_field)

    return render_template('form_individual.html')

@app.route('/get-rubric-data', methods=['GET'])
def get_rubric_data():
    selected_rubric = request.args.get('rubric')
    
    if selected_rubric in rubrics:
        data = {
            'status': list({item['Placement'] for item in rubrics[selected_rubric]}),
            'level': list({item['Level'] for item in rubrics[selected_rubric]}),
        }
        return jsonify(data)
    else:
        return jsonify({'status': [], 'level': []})

@app.route('/submit', methods=['POST'])
def submit():
    nis = request.form['nis']
    name = request.form['name']
    major = request.form['major']
    status = request.form['status']
    level = request.form['level']
    participant_as = request.form['participant_as']
    
    criteria = f"{status}|{level}|{participant_as}"
    display_criteria = f"{status}, {level}, {participant_as}"

    # Look up the score from the appropriate rubric data
    selected_rubric = request.form.get('rubric')
    score_row = pd.DataFrame(rubrics[selected_rubric])
    score_row = score_row[score_row['Criteria'] == criteria]
    
    score = score_row['Score'].values[0] if not score_row.empty else 0

    return render_template('form_submit_individual.html', nis=nis, name=name, major=major, criteria=criteria, display_criteria=display_criteria, score=score)

@app.route('/upload', methods=['POST'])
def upload():
    if 'file' not in request.files:
        return "No file part"
    
    file = request.files['file']
    
    if file.filename == '':
        return "No selected file"
    
    if file and file.filename.endswith('.csv'):
        df = pd.read_csv(file)
        
        results = []
        
        for index, row in df.iterrows():
            # Extract values from the row
            nis = row['NIS']
            name = row['Name']
            major = row['Major']
            status = row['Status']
            level = row['Level']
            participant_as = row['Participant As']
            
            criteria = f"{status}|{level}|{participant_as}"
            score_row = rubrics[rubrics['Criteria'] == criteria]
            score = score_row['Score'].values[0] if not score_row.empty else 0
            
            results.append({
                'nis': nis,
                'name': name,
                'major': major,
                'criteria': criteria,
                'score': score
            })
        
        return render_template('results.html', results=results)
    
    return "Invalid file format. Please upload a CSV file."

if __name__ == '__main__':
    app.run(debug=True)

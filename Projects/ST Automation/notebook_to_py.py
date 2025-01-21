from nbconvert import PythonExporter
import nbformat

notebook_path = r"c:\Users\hansj\OneDrive\Documents\Student Affairs\Projects\ST Automation\run.ipynb"

with open(notebook_path, 'r', encoding='utf-8') as f:
    notebook_content = nbformat.read(f, as_version=4)
    
exporter = PythonExporter()
script, _ = exporter.from_notebook_node(notebook_content)

file_path = r"c:\Users\hansj\OneDrive\Documents\Student Affairs\Projects\ST Automation\run.py"

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(script)
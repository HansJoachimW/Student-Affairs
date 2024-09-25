from flask_sqlalchemy import SQLAlchemy

db = SQLAlchemy()

class Result(db.Model):
    __tablename__ = 'results'  # Specify the table name
    id = db.Column(db.Integer, primary_key=True)
    result = db.Column(db.String(50))
    created_at = db.Column(db.DateTime, default=db.func.current_timestamp())

    def __repr__(self):
        return f'<Result {self.result}>'

from sqlalchemy import *

db = create_engine('mysql://t3st3r:123qwe@localhost/junk', echo=True)
meta = MetaData()
meta.bind = db

questions = Table('questions', meta, autoload=True)
quizzes = Table('quizzes', meta, autoload=True)
instructors = Table('instructors', meta, autoload=True)
students = Table('students', meta, autoload=True)
people = Table('people', meta, autoload=True)
sections = Table('sections', meta, autoload=True)
absences = Table('absences', meta, autoload=True)
assignments = Table('assignments', meta, autoload=True)
submissions = Table('submissions', meta, autoload=True)
grades = Table('grades', meta, autoload=True)
emails = Table('emails', meta, autoload=True)
courses = Table('courses', meta, autoload=True)


# for t in meta.sorted_tables:
#     print "table name: ", t.name
    
class Questions(object):
    pass

class Quizzes(object):
    pass

class Instructors(object):
    pass

class Students(object):
    pass

class People(object):
    pass

class Sections(object):
    pass

class Absences(object):
    pass

class Assignments(object):
    pass

class Submissions(object):
    pass

class Grades(object):
    pass

class Emails(object):
    pass

class Courses(object):
    pass

questions_map = mapper(Questions, questions)
quizzes_map = mapper(Quizzes, quizzes)
instructors_map = mapper(Instructors, instructors)
students_map = mapper(Students, students)
people_map = mapper(People, people)
sections_map = mapper(Sections, sections)
absences_map = mapper(Absences, absences)
assignments_map = mapper(Assignments, assignments)
submissions_map = mapper(Submissions, submissions)
grades_map = mapper(Grades, grades)
emails_map = mapper(Emails, emails)
courses_map = mapper(Courses, courses)

session = create_session()



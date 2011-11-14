import hashlib
import MySQLdb
from capstone import app
from flask import request, session, g, redirect, url_for, \
     abort, render_template, flash

def get_hashed(val):
    """returns an md5 hashed version of val.

    :param val: value to be hashed
    :type val: string
    :rtype: string
    :returns: the hashed string
    """
    hasher = hashlib.md5()
    hasher.update(val)
    return hasher.hexdigest()

def db_connect():
    g.db = MySQLdb.connect(host='localhost', user='t3st3r', passwd='123qwe', db='junk')
    g.cur = g.db.cursor()

def user_auth(user,pw):
    """checks whether a user/pw combo exists in the users collection.

    :param user: user name
    :type user: string
    :param pw: user password
    :type pw: string
    :rtype: bool
    :returns: bool indicating if auth was successful.
    """
    # pw    = get_hashed(pw)
    # valid = db.users.find_one({'name':user,'pw':pw})
    # return True if valid else False
    pass 

@app.route('/login', methods=['POST','GET'])
def login():
    # error = None
    # if request.method == 'POST':
    # return render_template('login.html')
    pass

@app.route('/register', methods=['POST','GET'])
def register():
    error = None
    db_connect()
    if 'POST' == request.method:
        pw = get_hashed(request.form['password'])
    else:
        tabs = g.cur.execute('select * from people')
        return render_template('register.html', tabs=tabs)

# app.config.from_object(__name__)

# DATABASE = '/tmp/flaskr.db'
# DEBUG = True
# SECRET_KEY = 'l33t'
# USERNAME = 'admin'
# PASSWORD = '123qwe'

# @app.before_request 
# def before_request():
#     '''
#     called before request, passed no args
#     '''
#     #g.db = connect_db()
#     pass

# # @app.after_request
# # def hrm(resp):
# #     '''
# #     called after request, passed the response object...
# #     must return a response object
# #     '''
# #     pass

# @app.teardown_request
# def teardown_request(exception):
#     '''
#     called after response object has been constructed, even on error
#     '''
#     #g.db.close()
#     pass

# def connect_db():
#     return sqlite3.connect(app.config['DATABASE'])

# def init_db():
#     with closing(connect_db()) as db:
#         with app.open_resource('schema.sql') as f:
#             db.cursor().executescript(f.read())
#         db.commit()

# @app.route('/login', methods=['GET', 'POST'])
# def login():
#     error = None
#     if request.method == 'POST':
#         if request.form['username'] != app.config['USERNAME']:
#             error = 'Invalid username'
#         elif request.form['password'] != app.config['PASSWORD']:
#             error = 'Invalid password'
#         else:
#             session['logged_in'] = True
#             flash('You were logged in')
#             return redirect(url_for('show_entries'))
#     return render_template('login.html', error=error)

# @app.route('/logout')
# def logout():
#     session.pop('logged_in', None)
#     flash('You were logged out')
#     return redirect(url_for('show_entries'))

# @app.route('/')
# def show_entries():
#     # cur = g.db.execute('select title, text from entries order by id desc')
#     # entries = [dict(title=row[0], text=row[1]) for row in cur.fetchall()]
#     # return render_template('show_entries.html', entries=entries)
#     #return render_template('show_entries.html', {'this':'that'})
#     return "hi"

# @app.route('/add/', methods=['POST'])
# def add_entry():
#     if not session.get('logged_in'):
#         abort(401)
#     g.db.execute('insert into entries (title,text) values (?, ?)',
#                  [request.form['title'], request.form['text']])
#     g.db.commit()
#     flash('New entry was successfully posted')
#     return redirect(url_for('show_entries'))

# if __name__ == '__main__':
#     app.run()

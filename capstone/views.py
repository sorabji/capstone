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
    g.db = MySQLdb.connect(host='localhost', user't3st3r', passwd='123qwe', db='junk')
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
    if 'POST' == request.method:
        db_connect()
        pw = get_hashed(request.form['password'])
        
        
    

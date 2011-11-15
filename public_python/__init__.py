from __future__ import with_statement
from flask import Flask

app = Flask(__name__)

import capstone.views

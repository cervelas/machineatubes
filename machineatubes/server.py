import json
import os
from functools import wraps

from flask import Flask, render_template

import webview

gui_dir = os.path.join(os.path.dirname(__file__), '..', 'machine')  # development path

server = Flask(__name__, static_folder=gui_dir, template_folder=gui_dir)
server.config['SEND_FILE_MAX_AGE_DEFAULT'] = 0  # disable caching

'''
@server.after_request
def add_header(response):
    response.headers['Cache-Control'] = 'public, max-age=604800, no-transform, immutable'
    return response
'''

@server.route('/')
def landing():
    """
    Render index.html. Initialization is performed asynchronously in initialize() function
    """
    return render_template('index.html')

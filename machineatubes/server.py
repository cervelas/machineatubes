import json
from pathlib import Path
from functools import wraps

from flask import Flask, render_template

import webview

base_dir = Path(__file__).parent.parent

server = Flask(__name__, static_folder=base_dir / "ui" / "assets", template_folder=base_dir / "ui")
server.config['SEND_FILE_MAX_AGE_DEFAULT'] = 0  # disable caching

'''
@server.after_request
def add_header(response):
    response.headers['Cache-Control'] = 'public, max-age=604800, no-transform, immutable'
    return response
'''

@server.route('/')
def machine():
    """
    Render index.html. Initialization is performed asynchronously in initialize() function
    """
    return render_template('machine.html')

@server.route('/ctrl')
def ctrl():
    """
    Render index.html. Initialization is performed asynchronously in initialize() function
    """
    return render_template('ctrl.html')

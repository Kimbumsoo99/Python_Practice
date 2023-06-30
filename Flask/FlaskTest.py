from flask import Flask , redirect, url_for

print('[Hello, Flask!]')
app = Flask(__name__)


@app.route('/hello')
def hello_Flask():
    return 'Hello, Flask!'

@app.route('/')
def index():
    return redirect(url_for('hello_Flask'))

if __name__ == '__main__':
    app.run(debug=True)
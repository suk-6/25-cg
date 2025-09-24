import os
import subprocess

from flask import Flask, request, render_template

APP = Flask(__name__)

try:
    with open("flag.txt", "w") as f:
        f.write(os.environ["FLAG"])
except:
    pass

@APP.route("/")
def index():
    return render_template("index.html")

@APP.route("/ping", methods=["GET", "POST"])
def ping():
    if request.method == "POST":
        host = request.form.get("host")
        for bad in ["cat", "flag.txt", "*", "?"]:
            if bad in host:
                return "no hack!"

        cmd = f'ping -c 3 "{host}"'
        print(cmd)
        try:
            output = subprocess.check_output(["/bin/sh", "-c", cmd], timeout=5)
            return render_template("ping_result.html", data=output.decode("utf-8"))
        except subprocess.TimeoutExpired:
            return render_template("ping_result.html", data="Timeout !")
        except subprocess.CalledProcessError:
            return render_template(
                "ping_result.html",
                data=f"an error occurred while executing the command. -> {cmd}",
            )

    return render_template("ping.html")

if __name__ == "__main__":
    APP.run(host="0.0.0.0", port=8000)

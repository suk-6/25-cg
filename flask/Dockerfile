FROM python:3.9-slim-buster

ENV TZ Asia/Seoul
ENV PYTHONIOENCODING UTF-8
ENV LC_CTYPE C.UTF-8

LABEL maintainer="https://suk.kr"

WORKDIR /app

RUN ["pip", "install", "flask", "requests"]

COPY . .

CMD ["python3", "app.py"]

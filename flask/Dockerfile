FROM python:3.9-slim

ENV TZ=Asia/Seoul
ENV PYTHONIOENCODING=UTF-8
ENV LC_CTYPE=C.UTF-8

LABEL maintainer="https://suk.kr"

WORKDIR /app


RUN ["pip", "install", "flask", "requests"]

RUN ["apt", "update"]
RUN ["apt", "install", "-y", "curl", "iputils-ping"]

COPY . .

CMD ["python3", "-u", "app.py"]

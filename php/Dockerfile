FROM php:7

ENV TZ Asia/Seoul
ENV PYTHONIOENCODING UTF-8
ENV LC_CTYPE C.UTF-8

LABEL maintainer="https://suk.kr"

WORKDIR /app

COPY . .

CMD ["php", "-S", "0.0.0.0:8000", "/app/index.php"]
FROM python:3

WORKDIR /usr/src/app

RUN pip install -r /usr/src/app/requirements.txt

RUN apt-get update && \
    apt-get install -y cron
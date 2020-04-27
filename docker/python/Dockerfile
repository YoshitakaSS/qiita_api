FROM python:3

ARG project_dir=/usr/src/app

RUN apt-get update && \
    apt-get install -y cron && \
    apt-get install -y vim

WORKDIR $project_dir

ADD requirements.txt $project_dir

RUN pip install -r /usr/src/app/requirements.txt
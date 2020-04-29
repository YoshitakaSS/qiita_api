FROM python:3

RUN pip install --upgrade pip

ARG project_dir=/usr/src/app

ENV TZ=Asia/Tokyo

RUN apt-get update && \
    apt-get install -y cron && \
    apt-get install -y vim && \
    apt-get install -y tzdata && \
    rm -rf /var/lib/apt/lists/* && \
    echo "${TZ}" > /etc/timezone && \
    rm /etc/localtime && \
    ln -s /usr/share/zoneinfo/Asia/Tokyo /etc/localtime && \
    dpkg-reconfigure -f noninteractive tzdata

WORKDIR $project_dir

ADD requirements.txt $project_dir/py/
RUN touch /var/log/cron.log

RUN pip install -r $project_dir/py/requirements.txt
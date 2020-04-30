FROM python:3

RUN pip install --upgrade pip

ARG project_dir=/usr/src/app

ENV TZ=Asia/Tokyo

RUN apt-get update && \
    apt-get install -y cron less vim tzdata && \
    rm -rf /var/lib/apt/lists/* && \
    echo "${TZ}" > /etc/timezone && \
    rm /etc/localtime && \
    ln -s /usr/share/zoneinfo/Asia/Tokyo /etc/localtime && \
    dpkg-reconfigure -f noninteractive tzdata

WORKDIR $project_dir

ADD requirements.txt $project_dir/py/
ADD ./etc/cron.d/ /etc/cron.d/

RUN chmod 0644 /etc/cron.d/* && \
    touch /var/log/cron.log && \
    crontab /etc/cron.d/qiita && \
    pip install -r $project_dir/py/requirements.txt
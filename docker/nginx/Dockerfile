FROM nginx:alpine

ADD ./conf.d/* /etc/nginx/conf.d/

ARG VIRTUAL_HOST

RUN sed -i -e "s/VIRTUAL_HOST/${VIRTUAL_HOST}/" /etc/nginx/conf.d/default.conf

CMD ["/usr/sbin/nginx", "-g", "daemon off;"]

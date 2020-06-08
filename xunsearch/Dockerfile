FROM alpine:3.10.2

ENV LANG en_US.UTF-8
ENV LANGUAGE en_US.UTF-8
ENV LC_ALL=en_US.UTF-8

RUN sed -i 's/dl-cdn.alpinelinux.org/mirrors.ustc.edu.cn/g' /etc/apk/repositories && \
    echo "Asia/Shanghai" > /etc/timezone

RUN apk add --no-cache gawk make gcc g++ zlib-dev

# Download & Install xunsearch-dev
RUN cd /root && wget -qO - http://www.xunsearch.com/download/xunsearch-full/xunsearch-full-1.4.13.tar.bz2 | tar xj
RUN cd /root/xunsearch-full-* && sh setup.sh --prefix=/usr/local/xunsearch

RUN echo '' >> /usr/local/xunsearch/bin/xs-ctl.sh \
    && echo 'tail -f /dev/null' >> /usr/local/xunsearch/bin/xs-ctl.sh

# Configure it
#VOLUME ["/usr/local/xunsearch/data"]
EXPOSE 8383
EXPOSE 8384

WORKDIR /usr/local/xunsearch
RUN echo "#!/bin/sh" > bin/xs-docker.sh \
    && echo "rm -f tmp/pid.*" >> bin/xs-docker.sh \
    && echo "echo -n > tmp/docker.log" >> bin/xs-docker.sh \
    && echo "bin/xs-indexd -l tmp/docker.log -k start" >> bin/xs-docker.sh \
    && echo "sleep 1" >> bin/xs-docker.sh \
    && echo "bin/xs-searchd -l tmp/docker.log -k start" >> bin/xs-docker.sh \
    && echo "sleep 1" >> bin/xs-docker.sh \
    && echo "tail -f tmp/docker.log" >> bin/xs-docker.sh

VOLUME [ "/usr/local/xunsearch/data" ]

# container init
RUN wget -O /usr/local/bin/dumb-init https://github.com/Yelp/dumb-init/releases/download/v1.2.1/dumb-init_1.2.1_amd64 && \
    echo "057ecd4ac1d3c3be31f82fc0848bf77b1326a975b4f8423fe31607205a0fe945  /usr/local/bin/dumb-init" | sha256sum -c - && \
    chmod 755 /usr/local/bin/dumb-init

ENTRYPOINT ["/usr/local/bin/dumb-init", "--"]
CMD ["bin/xs-docker.sh"]

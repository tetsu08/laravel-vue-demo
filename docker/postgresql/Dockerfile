FROM postgres:14.1-bullseye

ENV TZ=Asia/Tokyo \ 
　LANG=ja_JP.UTF-8 \
  LANGUAGE=ja_JP:ja \
  LC_ALL=ja_JP.UTF-8

RUN apt-get update && \
  apt-get install -y tzdata locales --no-install-recommends && \
  apt-get clean && \
  locale-gen && \
  localedef -f UTF-8 -i ja_JP ja_JP
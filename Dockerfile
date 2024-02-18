FROM ubuntu:latest
LABEL authors="Gabriel"

ENTRYPOINT ["top", "-b"]

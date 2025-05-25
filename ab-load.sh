#!/bin/zsh

URL="http://127.0.0.1:8000/"
DURATION_SEC=180
RPS_START=1
RPS_END=10

for ((t=0; t<${DURATION_SEC}; t++)); do
  # Calculate current RPS using zsh-compatible math
  rps=$(( RPS_START + (RPS_END - RPS_START) * t / DURATION_SEC ))

  echo "Second $t → sending $rps requests"

  for ((i=0; i<rps; i++)); do
    ab -n 1 -c 1 "$URL" >/dev/null 2>&1 &
  done

  sleep 1
done

wait


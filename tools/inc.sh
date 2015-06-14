for i in {1..100}
do
  curl -Xcurl -XPOST 'http://localhost/api.php/trigger' -d 'barid=2&action=inc&vol=1'
  sleep 1
done

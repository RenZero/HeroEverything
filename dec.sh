for i in {1..1000}
do
  curl -Xcurl -XPOST 'http://localhost/api.php/trigger' -d 'barid=2&action=dec&vol=2'
  sleep 1
done


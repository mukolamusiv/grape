@setup
 $user = 'chasosl';

 $path = 'home/chasosl/chasoslov.info';

 $current = $path.'/current';

 $repo = "git@github.com:mukolamusiv/grape.git";

 $branch = 'master';

 $chmods = [
        'storage/logs'
 ];

 $date = new DateTime('now');

 $release = $path.'/releases/'.$date->format('YmdHis');

@endsetup

@servers(['production'=>'sftp://chasosl@chasosl.ftp.tools'])





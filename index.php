<?php
if (isset($_POST['id']) && !empty($_POST['id'])) {
    echo 'downloading video. it will be added to your library after completion';

    $cmd = 'youtube-dl -o "videos/%(title)s.mp4" -f mp4 "https://www.youtube.com/watch?v="'.$_POST['id'].'"" > /dev/null 2>/dev/null &';
    shell_exec($cmd);
}
?>

<form action='' method='POST'>
    <input type='text' name='id' placeholder='YT Video ID'>
    <input type='submit'>
</form>
<hr>

<?php
$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(getcwd().'/videos'));
$files = array();

foreach ($rii as $file) {

    if ($file->isDir()){
        continue;
    }

    $files[] = $file->getFilename();

}



foreach ($files as $file) {

    echo '<a href=videos/'.rawurlencode($file).'>'.$file.'</a>';
    echo '<hr>';

}

?>

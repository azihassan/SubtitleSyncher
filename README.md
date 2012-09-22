Subtitle synchronizer.

If you ever watched a movie with unsynchronised subtitles, you would probably have noticed how annoying it can get. With this small utility, you can hopefully be able to get them back to a tolerable level.

Usage :
php subsyncher.php in.srt difference_in_seconds [out.srt]

-in.srt : The faulty subtitle file.

-difference_in_seconds : The amount of time you want to substract or add to the subtitle's timing.

-out.srt (optional) : If this parameter is specified, the updated subtitles will be written to the given file. Otherwise, the in.srt file will be modified.

<?php
namespace bvirk\data;

class Htable {
	static function winProgs() : array {
    	return explode("\n",
    	<<< EOLIST
		browser/email
		msacces
		jedit
		sketchup
		visual studio
		borland c++
		media player og vlc
		total commander
		java og ant
		visual studio
		borland assembler
		photoshop
		git
		cdburnerxp
		java og ant
		bat scripts
		vbscript/asp
		ffmpeg konvertering
		audacity
		imagemagick
		works for dos
		edlin and readme.com
		other dos commands
		EOLIST);
/*
EOLIST */
	}
	
	static function linuxProgs() {
		return explode("\n",
    	<<< EOLIST
		browser and email
		jedit
		java
		terminal as useinterface
		midnight commander
		bash programming
		youtube-dl
		mplayer
		audacious
		php
		apache
		mysql
		nemo
		celluoid
		ssh
		vsftpd
		lftp
		git
		EOLIST);/*
EOLIST */
	}
	
	static function macProgs() {
		return explode("\n",
		<<< EOLIST
		final cut pro
		finder
		EOLIST); /*
EOLIST */
	}
}

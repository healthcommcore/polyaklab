CREATE TABLE #__jooflickrgallery15 (
           	  `galleryHeight` varchar(3) NOT NULL default '0',
           	  `userFlickr` varchar(5) NOT NULL default 'false',
           	  `useFlickrLargeSize` varchar(5) NOT NULL default 'false',
           	  `flickrAPIKey` varchar(50) NOT NULL default 'a22b1a90b000578e1854ebdb3a3b5ba7',
           	  `photosetID` varchar(50) NOT NULL default '72157603505606537',
           	  `per_page` varchar(3) NOT NULL default '30',
           	  `useHoverIntent` varchar(5) NOT NULL default 'false',
           	  `useLightBox` varchar(5) NOT NULL default 'false',
           	  `myPhotoFolder` varchar(50) NOT NULL default 'myphotos'
           ) TYPE=MyISAM;           

INSERT INTO #__jooflickrgallery15 (galleryHeight, userFlickr, useFlickrLargeSize, flickrAPIKey, photosetID, per_page, useHoverIntent, useLightBox, myPhotoFolder) VALUES("0", "true", "true", "a22b1a90b000578e1854ebdb3a3b5ba7", "72157603505606537", "30", "true", "true", "stories");
ALTER TABLE `os`
ADD `pin` int(4) NULL,
ADD `patternlock` int(11) NULL AFTER `pin`;
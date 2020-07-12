sophosFlash obtains the latest virus information from sophos.com via XML. It adds the links to a db table for full display and also posts newest 10 to a block.

Built by usulix, usulix@yahoo.com

A possible security issue is the necessity of creating a new call to the xoops db class outside the admin directory to allow the flash information to be added to the DB table. It's in sophosFlash/class/sfup.php

Many thanks to the xoops team for a project that definitely deserves to be in the sourceforge most active and to sophos for the virus alert feeds.

Regards,

usulix
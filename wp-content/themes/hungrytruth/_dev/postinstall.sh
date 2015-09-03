#! /bin/bash
gulp sass-dev && chmod 664 ../style.css && chmod 664 ../*.php && chmod 664 ../screenshot.png && echo "Compiled initial style.css and updated permissions. You may now run: gulp dev"
# compass plugins
require 'compass-normalize'
require 'zen-grids'
require 'compass-photoshop-drop-shadow'

# :production :development
environment = :development
line_comments = false

# :expanded :nested :compact :compressed
# to be nice, we use :compact for production
output_style = :expanded

# source numbers
#sass_options = { :debug_info => true }

# project resources
http_path = "/"
http_images_path = "http://162.209.72.179/flashcards/wp-content/themes/flashcards/lib/img/"
http_fonts_path = "http://162.209.72.179/flashcards/wp-content/themes/flashcards/lib/fonts/"
css_dir = "/"
sass_dir = "lib/sass"
images_dir = "lib/img"
fonts_dir = "lib/fonts"
javascripts_dir = "lib/js"

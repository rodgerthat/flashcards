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
http_images_path = "http://162.209.72.179/flashcards/wp-content/themes/flashcards/assets/img/"
http_fonts_path = "http://162.209.72.179/flashcards/wp-content/themes/flashcards/assets/fonts/"
css_dir = "/"
sass_dir = "assets/sass"
images_dir = "assets/img"
fonts_dir = "assets/fonts"
javascripts_dir = "assets/js"

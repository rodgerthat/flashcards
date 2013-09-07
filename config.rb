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
#todo - update basecamp todos w/ this update config.rb image path
http_images_path = "http://127.0.0.1:8080/wordpress/wp-content/themes/flashcards/lib/images/"
css_dir = "/"
sass_dir = "library/sass"
images_dir = "library/images"
javascripts_dir = "library/js"

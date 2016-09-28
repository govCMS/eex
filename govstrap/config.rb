# Change this to :production when ready to deploy the CSS to the live server.
environment = :development

# Require any additional compass plugins here.
require 'compass'
require 'compass/import-once/activate'

# Location of the theme's resources.
http_path = "/"
css_dir = "css"
sass_dir = "src/sass"
images_dir = "img"
javascripts_dir = "js"
fonts_dir = "fonts"
output_style = :nested

output_style = (environment == :development) ? :expanded : :compressed

relative_assets = true

line_comments = (environment == :development) ? true : false

# CSS sourcemaps.
sourcemap = false
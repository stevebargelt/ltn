build: 
	jekyll build
test:
	bundle exec htmlproofer ./_site --http-status-ignore "999"
clean:
	jekyll clean
serve:
	jekyll serve --watch

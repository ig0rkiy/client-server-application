import webview

TITLE = "FileManager"
URL = "http://localhost:81/%d0%a3%d1%87%d1%91%d0%b1%d0%b0/%d0%a0%d0%a1%d0%9a%d0%9f/%d0%9a%d0%a3%d0%a0%d0%a1%d0%9e%d0%92%d0%90%d0%af/FileManager/src/Server/"
HEIGHT = 800
WIDTH = 900


webview.create_window(
	TITLE, URL, html="",
	js_api=None, width=WIDTH, height=HEIGHT,
	x=None, y=None, resizable=False,
	fullscreen=False, min_size=(WIDTH, HEIGHT), hidden=False,
	frameless=False, minimized=False, on_top=False,
	confirm_close=False, background_color="#FFF", text_select=False)

webview.start()

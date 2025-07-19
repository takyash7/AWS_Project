
import streamlit as st
from pytube import YouTube
import instaloader
import os

st.title("🎥 YouTube & Instagram Reels Downloader")

url = st.text_input("Enter URL (YouTube or Instagram Reel)")

if st.button("Download"):
    if "youtube.com" in url or "youtu.be" in url:
        try:
            yt = YouTube(url)
            stream = yt.streams.get_highest_resolution()
            stream.download(output_path="downloads/")
            st.success("✅ YouTube video downloaded!")
        except Exception as e:
            st.error(f"Error: {e}")

    elif "instagram.com/reel" in url:
        try:
            L = instaloader.Instaloader()
            shortcode = url.rstrip("/").split("/")[-1]
            post = instaloader.Post.from_shortcode(L.context, shortcode)
            L.download_post(post, target="downloads")
            st.success("✅ Instagram Reel downloaded!")
        except Exception as e:
            st.error(f"Error: {e}")
    else:
        st.warning("❌ Invalid URL")

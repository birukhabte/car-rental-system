#!/usr/bin/env python3
"""
Simple HTTP Server for Car Rental Frontend
Run with: python server.py
"""

import http.server
import socketserver
import os
import webbrowser
from pathlib import Path

# Configuration
PORT = 8000
HOST = 'localhost'

class CustomHTTPRequestHandler(http.server.SimpleHTTPRequestHandler):
    def end_headers(self):
        # Add CORS headers to allow local file access
        self.send_header('Access-Control-Allow-Origin', '*')
        self.send_header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
        self.send_header('Access-Control-Allow-Headers', 'Content-Type')
        super().end_headers()
    
    def do_GET(self):
        # Redirect root to simple-index.html
        if self.path == '/':
            self.path = '/simple-index.html'
        return super().do_GET()

def main():
    # Change to the directory containing this script
    os.chdir(Path(__file__).parent)
    
    # Create server
    with socketserver.TCPServer((HOST, PORT), CustomHTTPRequestHandler) as httpd:
        server_url = f"http://{HOST}:{PORT}"
        
        print("=" * 60)
        print("🚗 Car Rental Frontend Server")
        print("=" * 60)
        print(f"Server running at: {server_url}")
        print(f"Main page: {server_url}/simple-index.html")
        print(f"Test page: {server_url}/test.html")
        print(f"Original: {server_url}/index.html")
        print("=" * 60)
        print("Press Ctrl+C to stop the server")
        print("=" * 60)
        
        # Try to open browser automatically
        try:
            webbrowser.open(f"{server_url}/simple-index.html")
            print("✅ Browser opened automatically")
        except:
            print("⚠️  Please open your browser manually")
        
        # Start server
        try:
            httpd.serve_forever()
        except KeyboardInterrupt:
            print("\n🛑 Server stopped")

if __name__ == "__main__":
    main()
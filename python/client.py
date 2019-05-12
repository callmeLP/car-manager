from socket import *
import tkinter as tk
from tkinter import messagebox
import webbrowser
import json

host = 'localhost'
port = 8888
bufsiz = 1024

def sendData(data):
    tcpCliSock = socket(AF_INET, SOCK_STREAM)    # 开启套接字
    tcpCliSock.connect((host, port))             # 连接到服务器
    tcpCliSock.settimeout(5)
    data = data.encode()
    tcpCliSock.send(data)       # 发送信息

    response = tcpCliSock.recv(bufsiz)       # 接受返回信息
    if (response != b'OK'):
        raise Exception("服务器错误")
    tcpCliSock.close()

class App:
    def __init__(self, root):
        tk.Label(root, text = '车牌号(无牌车辆):' ).grid(row = 0)
        tk.Label(root, text='入/出:').grid(row = 1)
        self.e1 = tk.Entry(root)
        self.e1.grid(row = 0, column = 1, padx = 10, pady = 5)
        self.e2 = tk.Entry(root)
        self.e2.grid(row = 1, column = 1, padx = 10, pady = 5)

        tk.Button(root, text = '管理界面', width = 10, command = self.openUrl).\
            grid(row = 2, column = 0, padx = 10, pady = 5)
        tk.Button(root, text = '上传', width = 10, command = self.show).\
            grid(row = 2, column = 1, padx = 10, pady = 5)

    def show(self):
        print('车牌：' + self.e1.get())
        print('入/出：' + self.e2.get())
        dict = {}
        dict['carNum'] = self.e1.get()
        dict['remark'] = self.e2.get()
        data = json.dumps(dict)
        print(data)
        try:
            sendData(data)
        except:
            tk.messagebox.showerror(title = '错误', message = '上传失败')
        else:
            tk.messagebox.showinfo(title = '成功', message = '上传成功')

    def openUrl(self):
        webbrowser.open("127.0.0.1")


if __name__ == "__main__":
    root = tk.Tk()
    app = App(root)
    root.mainloop()
import socket
import json
import pymysql
import time

from multiprocessing import Process

def connectDB(carNum, inOrOut):
    link = pymysql.connect("localhost", "root", "root", "schoolcarmanager")
    cursor = link.cursor()
    sql = "INSERT INTO inoutinf(carNum, time, inOrOut) VALUES(\""+carNum+"\",\""+time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())+"\",\""+inOrOut+"\")"
    print(sql)
    cursor.execute(sql)
    results = cursor.fetchall()
    print(results)
    link.commit()  # 提交数据
    cursor.close()
    link.close()

def handle_client(client_socket):
    """处理客户端请求"""
    # 获取客户端请求数据
    request_data = client_socket.recv(1024)
    print("request data:", request_data)

    #json解析
    Data = json.loads(request_data)
    print(Data)
    try:
        #将数据加入数据库
        connectDB(Data['carNum'], Data['remark'])
    except:
        print("数据库错误")
    else:
        #响应数据
        response = "OK"
        print("response data:", response)
        # 向客户端返回响应数据
        client_socket.send(bytes(response, "utf-8"))

    # 关闭客户端连接
    client_socket.close()


if __name__ == "__main__":
    server_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    server_socket.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
    server_socket.bind(("", 8888))
    server_socket.listen(128)

    while True:
        client_socket, client_address = server_socket.accept()
        # print("[%s, %s]用户连接上了" % (client_address[0],client_address[1]))
        print("[%s, %s]用户连接上了" % client_address)
        handle_client_process = Process(target=handle_client, args=(client_socket,))
        handle_client_process.start()
        client_socket.close()

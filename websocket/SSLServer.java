import java.io.*;
import java.net.*;
import javax.net.ssl.*;
import javax.net.*;

public class SSLServer{
	public static void main(String[] args) throws IOException, javax.net.ssl.SSLHandshakeException {
		//Settings per certificato autenticazione
		System.setProperty("javax.net.ssl.keyStore", "keystore.jks");
		System.setProperty("javax.net.ssl.keyStorePassword", "password");

		//Creazione SocketServer
		ServerSocket server_socket = ((SSLServerSocketFactory)SSLServerSocketFactory.getDefault()).createServerSocket(12345, 23456);
		System.out.println("Olimpiadi Raffaellesche - Server TCP - versione 2.0 - (C) 2019-20\n --- IN ATTESA DI UN CLIENT ---");
		
		//Istanza Thread per ogni nuova connessione ricevuta
		while(true) new ThreadServer(server_socket.accept()).start();
	}
}
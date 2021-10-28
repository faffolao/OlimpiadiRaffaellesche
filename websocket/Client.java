import java.io.*;
import java.net.*;
import javax.net.ssl.*;
import javax.net.*;

public class Client {
	public static void main(String[] args) throws UnknownHostException, IOException, javax.net.ssl.SSLException {
		//Definizione Host [Server]
		String host = "olimpiadi-raffaellesche.itisurbino.edu.it";
		
		//Settings per certificato autenticazione
		System.setProperty("javax.net.ssl.trustStore", "keystore.jks");
		System.setProperty("javax.net.ssl.trustStorePassword", "password");
		
		//Creazione Socket Client
		Socket socket = ((SSLSocketFactory)SSLSocketFactory.getDefault()).createSocket(host, 12345);  
		
		//Inizializzazione buffer Input/Output      
        BufferedReader socketBufferedReader = new BufferedReader(new InputStreamReader(socket.getInputStream()));
		PrintWriter socketPrintWriter = new PrintWriter(socket.getOutputStream(), true);
		BufferedReader commandPromptBufferedReader = new BufferedReader(new InputStreamReader(System.in));
		
	//	System.out.println("USERNAME: ");
	//	socketPrintWriter.println(commandPromptBufferedReader.readLine());
		
		String msg = null;
		while(true){
			//Recupero messaggio Client
			System.out.println("Enter a msg to send to Remote Server: ");
			msg = commandPromptBufferedReader.readLine();
			
			//Se verificata - Chiusura Connessione da parte del Server
			if(msg.equals("quit") || msg.equals("exit") || msg.equals("^C") || msg.equals("^c")){
				socketBufferedReader.close();
				socketPrintWriter.close();
				commandPromptBufferedReader.close();
				socket.close();
				System.out.println("Connection Break");
				break;
			} else {
				//Invio messaggio al Server 	
				socketPrintWriter.println(msg);
				
				//Stamopa a video della risposta del Server
				System.out.print("Reply From Server: ");
				System.out.println(socketBufferedReader.readLine());
			}	
		}
	}
}

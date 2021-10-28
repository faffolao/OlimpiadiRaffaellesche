import java.io.*;
import java.net.*;
import javax.net.*;

public class ThreadServer extends Thread{
	Socket socket;
	ThreadServer(Socket socket){
		this.socket = socket;
	}
	
	public void run(){
		try{
			//Inizializzazione Buffer Input/Output
			PrintWriter print_writer = new PrintWriter(socket.getOutputStream(), true);
			BufferedReader buffered_reader = new BufferedReader(new InputStreamReader(socket.getInputStream()));
			
			//Verifica Utente Connesso - Recuper Indirizzo Socket di connessione 
			System.out.println("--- [addr=" + socket.getRemoteSocketAddress().toString() + ", Connected To Server Local Port => " + socket.getLocalPort() + "] ---");
						
			//Ciclo Infinito			
			while(true){		
				//Tentativo esecuzione comandi
				try{
					//Recupero il buffer di lettura
					String sent_from_client = buffered_reader.readLine();
					
					//Controllo per termine connessione in caso di pression CTRL + C
					if((sent_from_client) == null){
						break;
					}
					
					//Restituzione al client del messaggio spedito
					print_writer.println("[ " + sent_from_client + " Echo By Server ]");
					
					//Stampa a video invio/ricezione dati Client - Server
					System.out.println("Msg From Socket Client[addr="+ socket.getRemoteSocketAddress().toString() + "]: < " + sent_from_client + " > | Replied[addr="+ socket.getLocalSocketAddress().toString() + "]: < " + sent_from_client + " > ");
				//Entra se viene verificata la condizione del Client Java (Invio da parte del client [Quit / Exit])
				} catch(javax.net.ssl.SSLHandshakeException e){
					break;
				}
			}
			
			//Avviso chiusura connessione con client
			System.out.println("Connection Break");
		} catch(IOException e) {
			//Entra per qualsiasi altra eccezione non gestita [ES: errore apertura socket / tentativo di connessione con client fallito]
			System.out.println("Error: " + e.getMessage());
			//Stampa tutto lo stack trace errore
			e.printStackTrace();
		}
	}
}
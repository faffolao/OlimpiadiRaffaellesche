
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.Socket;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author rocco
 */
public class SocketServer implements Runnable{
    public Socket clientSocket;
    
    
    
    public SocketServer(Socket client){
        this.clientSocket = client;
    }
    
    
    public void run(){
        try{
            // creazione flusso i/o dati
            PrintWriter out = new PrintWriter(clientSocket.getOutputStream(), true);
            BufferedReader in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
            System.out.println("Client connesso nella porta 12345. Server pronto a ricevere/inviare richieste.");
            String inputLine;
            
            // il server rimane in attesa di messaggi fino a quando non viene chiusa la connessione
            while((inputLine = in.readLine()) != null){
                System.out.println("Messaggio da " + clientSocket.toString() + ": " + inputLine);
                // lo stesso messaggio che riceve il server dal client viene reinviato a quest'ultimo
                out.println(inputLine);
            }
               
            // connessione terminata
            System.out.println("Connessione chiusa.");
        }catch(IOException e){
            System.out.println("La connessione è stata chiusa, o si è verificato un errore durante l'apertura della porta 7777 o nell'attesa della connessione");
            
        }
    }
    
}


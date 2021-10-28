/*  Server TCP per Olimpiadi Raffaellesche */


/**
 *
 * @author Federico
 */

import java.io.IOException;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.Vector;

public class Server {
    public static void main(String argv[]) throws Exception{
        
        Vector vector = new Vector();
        
        
        try{
            // definizione server socket
            ServerSocket serverSocket = new ServerSocket(12345);
            System.out.println("Olimpiadi Raffaellesche - Server TCP - versione 2.0 - (C) 2019-20\nIn attesa di un client...");

            while(true){
                try{
                    Socket clientSocket = serverSocket.accept();
                    new Thread(new SocketServer(clientSocket)).start();
                }catch(IOException e){
                    System.out.println("La connessione è stata chiusa, o si è verificato un errore durante l'apertura della porta 7777 o nell'attesa della connessione");
                }
            }
        }catch(Exception e){
            System.out.println("La connessione è stata chiusa, o si è verificato un errore durante l'apertura della porta 7777 o nell'attesa della connessione");
        }
    }
}


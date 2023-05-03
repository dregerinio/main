

#include <ESP8266WiFi.h>
#include <ArduinoWiFiServer.h>


#ifndef STASSID
#define STASSID "Dregera"
#define STAPSK "mnogoetrudna"
#endif

const char* ssid = STASSID;
const char* password = STAPSK;

ArduinoWiFiServer pass_server(2323);
ArduinoWiFiServer simon_door_server(2325);
ArduinoWiFiServer door1_server(2324);
ArduinoWiFiServer switch1_server(2326);

String incomingString;
String simon_door = "0";
String door1 = "0";
String switch1 = "0";
String pass = "0";
void setup() {

  Serial.begin(115200);
  while (!Serial)
    ;
  //Serial.println();
  // Serial.print("Connecting to ");
  // Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    // Serial.print(".");
  }

  pass_server.begin();
  simon_door_server.begin();
  door1_server.begin();
  switch1_server.begin();

  IPAddress ip = WiFi.localIP();
  // Serial.println();
  //  Serial.println("Connected to WiFi network.");
  //  Serial.print("To access the server, connect with Telnet client to ");
  // Serial.print(ip);
  // Serial.println(" 2323");
}

void loop() {

  if (Serial.available() > 0) {
    incomingString = Serial.readStringUntil('.');
    if (incomingString == "simon")
      simon_door = Serial.readStringUntil('.');
    else if (incomingString == "pass")
      pass = Serial.readStringUntil('.');
    else if (incomingString == "door1")
      door1 = Serial.readStringUntil('.');
    else if (incomingString == "switch1")
      switch1 = Serial.readStringUntil('.');
  }
  incomingString = " ";

  simon_door_server_func();
  door1_server_func();
  pass_server_func();
  switch1_server_func();
}

void pass_server_func() {
  WiFiClient client = pass_server.available();  // returns first client which has data to read or a 'false' client
  if (client) {                                 // client is true only if it is connected and has data to read
    String req = "";
    int read_buffer = 0;
    //   Serial.println("new door1 client");
    // an http request ends with a blank line
    boolean currentLineIsBlank = true;
    unsigned int counter = 0;
    unsigned int end_of_string = 0;
    while (client.connected()) {
      if (client.available()) {
        char c = client.read();
        //  Serial.write(c);
        if (c == ' ') {
            if(read_buffer){
                end_of_string = 1;
            }
          read_buffer = 0;
          //  Serial.println("END");
        }
        if (read_buffer == 1)
          req += c;
        if (c == '/' && !end_of_string) {
          read_buffer = 1;
          // Serial.println("BEGIN");
        }
        // Serial.write(c - '0');
        //      for (int i = 0; i < 4; i++)
        //       digitalWrite(i + offset, 0);
        // if you've gotten to the end of the line (received a newline
        // character) and the line is blank, the http request has ended,
        // so you can send a reply
        if (c == '\n' && currentLineIsBlank) {


          // send a standard http response header
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println("Connection: close");  // the connection will be closed after completion of the response
          client.println();
          client.println("<!DOCTYPE HTML>");
          client.println(pass);
          break;
        }
        if (c == '\n') {
          // you're starting a new line
          currentLineIsBlank = true;
        } else if (c != '\r') {
          // you've gotten a character on the current line
          currentLineIsBlank = false;
        }
      }
      counter++;
    }
    // give the web browser time to receive the data
    delay(1);
    // close the connection:
    client.stop();
    Serial.write("pass.");
    Serial.write(req.c_str());
    Serial.write('.');
  }
}


void simon_door_server_func() {

  WiFiClient client = simon_door_server.available();  // returns first client which has data to read or a 'false' client
  if (client) {                                       // client is true only if it is connected and has data to read
    String req = "";
    int read_buffer = 0;
    //   Serial.println("new door1 client");
    // an http request ends with a blank line
    boolean currentLineIsBlank = true;
    unsigned int counter = 0;
    unsigned int end_of_string = 0;
    while (client.connected()) {
      if (client.available()) {
        char c = client.read();
        // Serial.write(c);
        if (c == ' ') {
          if(read_buffer){
            end_of_string = 1;
          }
          read_buffer = 0;
          
          //  Serial.println("END");
        }
        if (read_buffer == 1)
          req += c;
        if (c == '/' && !end_of_string) {
          read_buffer = 1;
          // Serial.println("BEGIN");
        }
        // Serial.write(c - '0');
        //      for (int i = 0; i < 4; i++)
        //       digitalWrite(i + offset, 0);
        // if you've gotten to the end of the line (received a newline
        // character) and the line is blank, the http request has ended,
        // so you can send a reply
        if (c == '\n' && currentLineIsBlank) {


          // send a standard http response header
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println("Connection: close");  // the connection will be closed after completion of the response
          client.println();
          client.println("<!DOCTYPE HTML>");
          client.println(simon_door);
          break;
        }
        if (c == '\n') {
          // you're starting a new line
          currentLineIsBlank = true;
        } else if (c != '\r') {
          // you've gotten a character on the current line
          currentLineIsBlank = false;
        }
      }
      counter++;
    }
    // give the web browser time to receive the data
    delay(1);
    // close the connection:
    client.stop();
    Serial.write("simon.");
    Serial.write(req.c_str());
    Serial.write('.');
  }
}



void door1_server_func() {

  WiFiClient client = door1_server.available();  // returns first client which has data to read or a 'false' client
  if (client) {                                  // client is true only if it is connected and has data to read
    String req = "";
    int read_buffer = 0;
    //   Serial.println("new door1 client");
    // an http request ends with a blank line
    boolean currentLineIsBlank = true;
    unsigned int counter = 0;
    unsigned int end_of_string = 0;
    while (client.connected()) {
      if (client.available()) {
        char c = client.read();
        //  Serial.write(c);
        if (c == ' ') {
            if(read_buffer){
                end_of_string = 1;
            }
          read_buffer = 0;
          //  Serial.println("END");
        }
        if (read_buffer == 1)
          req += c;
        if (c == '/' && !end_of_string) {
          read_buffer = 1;
          // Serial.println("BEGIN");
        }
        // Serial.write(c - '0');
        //      for (int i = 0; i < 4; i++)
        //       digitalWrite(i + offset, 0);
        // if you've gotten to the end of the line (received a newline
        // character) and the line is blank, the http request has ended,
        // so you can send a reply
        if (c == '\n' && currentLineIsBlank) {
          // send a standard http response header
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println("Connection: close");  // the connection will be closed after completion of the response
          client.println();
          client.println("<!DOCTYPE HTML>");
          client.println(door1);
          break;
        }
        if (c == '\n') {
          // you're starting a new line
          currentLineIsBlank = true;
        } else if (c != '\r') {
          // you've gotten a character on the current line
          currentLineIsBlank = false;
        }
      }
      counter++;
    }
    // give the web browser time to receive the data
    delay(1);
    // close the connection:
    client.stop();
    Serial.write("door1.");
    Serial.write(req.c_str());
    Serial.write('.');
  }
}


void switch1_server_func() {

  WiFiClient client = switch1_server.available();  // returns first client which has data to read or a 'false' client
  if (client) {                                    // client is true only if it is connected and has data to read
    String req = "";
    int read_buffer = 0;
    //   Serial.println("new door1 client");
    // an http request ends with a blank line
    boolean currentLineIsBlank = true;
    unsigned int counter = 0;
    unsigned int end_of_string = 0;
    while (client.connected()) {
      if (client.available()) {
        char c = client.read();
        //  Serial.write(c);
        if (c == ' ') {
            if(read_buffer){
                end_of_string = 1;
            }
          read_buffer = 0;
          //  Serial.println("END");
        }
        if (read_buffer == 1)
          req += c;
        if (c == '/' && !end_of_string) {
          read_buffer = 1;
          // Serial.println("BEGIN");
        }
        // Serial.write(c - '0');
        //      for (int i = 0; i < 4; i++)
        //       digitalWrite(i + offset, 0);
        // if you've gotten to the end of the line (received a newline
        // character) and the line is blank, the http request has ended,
        // so you can send a reply
        if (c == '\n' && currentLineIsBlank) {
          // send a standard http response header
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println("Connection: close");  // the connection will be closed after completion of the response
          client.println();
          client.println("<!DOCTYPE HTML>");
          client.println(switch1);
          break;
        }
        if (c == '\n') {
          // you're starting a new line
          currentLineIsBlank = true;
        } else if (c != '\r') {
          // you've gotten a character on the current line
          currentLineIsBlank = false;
        }
      }
      counter++;
    }
    // give the web browser time to receive the data
    delay(1);
    // close the connection:
    client.stop();
    Serial.write("switch1.");
    Serial.write(req.c_str());
    Serial.write('.');
  }
}

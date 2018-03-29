package main

import (
  "encoding/json"
  "fmt"
  "net/http"
)

func handler(w http.ResponseWriter,r *http.Request) {
    fmt.Fprintf(w, "Welcome, %s",r.URL.Path[1:])
}

func main()  {
  fmt.Println("Server listening... ")
  http.HandleFunc("/",handler)
  http.HandleFunc("/about/", about)
  http.ListenAndServe(":8080", nil)

}

type Message struct {
  Text string
}

func about (w http.ResponseWriter,r *http.Request) {
  m := Message{"Welcome to the home page of Node Capital LLC"}
  b,err := json.Marshal(m)

  if err != nil {
    panic(err)
  }
  w.Write(b)
}

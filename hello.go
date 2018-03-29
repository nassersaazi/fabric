package main

import (
  "fmt"
  "os"
  "strings"
  "math"
  "container/list"
  "crypto/sha1"
)

func add(args ...int) int {
  total := 0
  for _, v := range args {
  total += v
  }
  return total
}

type Circle struct {
  x, y, r float64
}
// QUESTION: wat r u saying
func main() {
  //lists
  var q list.List
  q.PushBack(1)
  q.PushBack(2)
  q.PushBack(3)
  for e := q.Front(); e != nil; e=e.Next() {
  fmt.Println(e.Value.(int))
  }

  fmt.Println(add(1,2,3))

  c := 0
  increment := func() int {
  c++
  return c
  }
  fmt.Println(increment())
  fmt.Println(increment())
  who := "World!"
  if len(os.Args) > 1 { /* os.Args[0] is "hello" or "hello.exe" */
    who = strings.Join(os.Args[1:], " ")

  }
  fmt.Println("hello",who)
  fmt.Println("1 + 1 =", 1 + 1)
  var x string = "Hello World"
  fmt.Println(x)
  //var x string
  x = "first "
  fmt.Println(x)
  x = x + "second"
  fmt.Println(x)
  x = "hello"
  var y string = "world"
  fmt.Println(x == y)
  z := 5
  fmt.Println(z)
  name := "Max"
  fmt.Println("My dog's name is", name)
  const a = "Hello World"
  //a = "Some other string"
  fmt.Println(a)
  //fmt.Print("Enter a number: ")
  /*var input float64
  fmt.Scanf("%f", &input)
  output := input * 2
  fmt.Println(output)*/

  /*for i := 1; i <= 10; i++ {
    if i % 2 == 0 {
      fmt.Println(i, "even")
      } else {
        fmt.Println(i, "odd")
        }

    switch i {
      case 0: fmt.Println("Zero")
      case 1: fmt.Println("One")
      case 2: fmt.Println("Two")
      case 3: fmt.Println("Three")
      case 4: fmt.Println("Four")
      case 5: fmt.Println("Five")
      default: fmt.Println("Unknown Number")
      }

}*/

  // crypto-hash functions
  h := sha1.New()
  h.Write([]byte("test"))
  bs := h.Sum([]byte{})
  fmt.Println(bs)


  var m [5]int
  m[4] = 100
  fmt.Println(m)

  var n [5]float64
  n[0] = 98
  n[1] = 93
  n[2] = 77
  n[3] = 82
  n[4] = 83
  var total float64 = 0
  for _, value := range n {
  total += value
  }
  fmt.Println(total / float64(len(n)))

  xs := []float64{98,104,77,82,83}
  fmt.Println(average(xs))

  //slices
  slice1 := []int{1,2,3}
  slice2 := append(slice1, 4, 5)
  fmt.Println(slice1, slice2)
  slice3 := []int{1,2,3}
  slice4 := make([]int, 2)
  copy(slice4, slice3)
  fmt.Println(slice3, slice4)

  //maps
  t := make(map[string]int)
  t["key"] = 10
  fmt.Println(t["key"])

  elements := map[string]map[string]string{
      "H": map[string]string{
      "name":"Hydrogen",
      "state":"gas",
      },
      "He": map[string]string{
      "name":"Helium",
      "state":"gas",
      },
      "Li": map[string]string{
      "name":"Lithium",
      "state":"solid",
      },
      "Be": map[string]string{
        "name":"Beryllium",
        "state":"solid",
        },
        "B": map[string]string{
        "name":"Boron",
        "state":"solid",
        },
        "C": map[string]string{
        "name":"Carbon",
        "state":"solid",
        },
        "N": map[string]string{
        "name":"Nitrogen",
        "state":"gas",
        },
        "O": map[string]string{
        "name":"Oxygen",
        "state":"gas",
        },
        "F": map[string]string{
        "name":"Fluorine",
        "state":"gas",
        },
        "Ne": map[string]string{
        "name":"Neon",
        "state":"gas",
        },
        }
        if el, ok := elements["Un"]; ok {
        fmt.Println(el["name"], el["state"])
        }
        //structs
        p := Circle{0,0,5}
        fmt.Println(p.x,p.y,p.r)
        fmt.Println(p.area())


  defer func() {
  str := recover()
  fmt.Println(str)
  }()
  panic("PANIC")

}


func average(xs []float64) float64 {
  total := 0.0
  for _, v := range xs {
  total += v
  }
  return total / float64(len(xs))
}

func (c *Circle) area() float64 {
    return math.Pi * c.r*c.r
}

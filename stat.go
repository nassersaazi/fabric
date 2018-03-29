package main

import (
  "fmt"
)

const (
  ROWSIZE int = 6
  COLSIZE int = 2
)

var gradesArray [ROWSIZE][COLSIZE]int
var expValueArray [ROWSIZE][COLSIZE]float64
var grandTotal int = 0
var rowArray [ROWSIZE]int
var colArray [COLSIZE]int

func main()  {
  gradesArray = [ROWSIZE][COLSIZE]int{
                  {200 ,300},
                  {4000,3000},
                  {500,7000},
                  {2000,2355},
                  {700,400},
                  {300,200}}

  gradeTable()
  fmt.Println("")
  expValueTable();
  fmt.Println("")
  CSValueTable();
}// end main

func gradeTable()  {
  fmt.Println("========================================")
  fmt.Println("ORIGINAL TABLE" )
  fmt.Println("========================================")
  index,col0,col1 := 0,0,0
  printHeaders()

  for i := 0;i < ROWSIZE;i++ {
    rowTotal := 0
    fmt.Printf("%s%-2d", "\nGrade " ,i+1 )
    for j := 0;j < COLSIZE; j++ {
      fmt.Printf("    %-18d",gradesArray[i][j] )
      switch j {
      case 0: col0 += gradesArray[i][j]
      case 1: col1 += gradesArray[i][j]
      default: fmt.Println("Error")
      }//end switch
      rowTotal += gradesArray[i][j]
    } // end inner for
    fmt.Println(rowTotal)
    rowArray[index] = rowTotal
    index++
    grandTotal += rowTotal
    } // end outer for

  colArray[0],colArray[1] = col0,col1
  fmt.Printf("Total")
  fmt.Printf("     %-18d    %-18d%-18d\n",colArray[0],colArray[1],grandTotal);
} // end gradeTable

func expValueTable()  {
  fmt.Println("========================================")
  fmt.Println("EXPECTED_VALUES TABLE" )
  fmt.Println("========================================")

  col0,col1 := 0.0,0.0
  grandTotalEx := 0.0
  //var rowArrayEx [ROWSIZE]float64
  var colArrayEx [COLSIZE]float64
  printHeaders()

  for i := 0;i < ROWSIZE;i++ {
    rowTotal := 0.0
    fmt.Printf("%s%-2d", "\nGrade " ,i+1 )
    for j := 0;j < COLSIZE; j++ {

      expValueArray[i][j] = expValueCalc(&rowArray[i], &colArray[j],grandTotal)
      fmt.Printf("     %-18.2f",expValueArray[i][j] )

      switch j {
      case 0: col0 += expValueArray[i][j]
      case 1: (col1) += expValueArray[i][j]
      default: fmt.Println("Error")
      }//end switch
      rowTotal += expValueArray[i][j]
    } // end inner for
    fmt.Printf("%.2f",rowTotal)
    grandTotalEx += rowTotal
    } // end outer for

    colArrayEx[0],colArrayEx[1] = (col0),(col1)
    fmt.Printf("%s", "\nTotal")
    fmt.Printf("     %-18.2f     %-18.2f%-18.2f\n",colArrayEx[0],colArrayEx[1],grandTotalEx);

} //end func expValueTable

func expValueCalc(rowArrayptr,colArrayptr *int,grandTotal int) float64  {
  x := *rowArrayptr
  y := *colArrayptr
  var z float64 = float64((x * y) / grandTotal)
  return z
}// end func expVa lueCalc

func CSValueTable()  {
  fmt.Println("========================================")
  fmt.Println("CS_VALUES TABLE" )
  fmt.Println("========================================")

  var CSValueArray [ROWSIZE][COLSIZE]float64
  col0,col1 := 0.0,0.0
  grandTotalCS := 0.0
  var colArrayCS [COLSIZE]float64
  printHeaders()

  for i := 0;i < ROWSIZE;i++ {
    rowTotal := 0.0
    fmt.Printf("%s%-2d", "\nGrade " ,i+1 )
    for j := 0;j < COLSIZE; j++ {

      CSValueArray[i][j] = CSValueCalc(&gradesArray[i][j], &expValueArray[i][j])
      fmt.Printf("     %-18.2f",CSValueArray[i][j] )
      switch j {
      case 0: col0 += CSValueArray[i][j]
      case 1: col1 += CSValueArray[i][j]
      default: fmt.Println("Error")
      }//end switch
      rowTotal += CSValueArray[i][j]
    } // end inner for
    fmt.Printf("%.2f",rowTotal)
    grandTotalCS += rowTotal
    } // end outer for
    colArrayCS[0],colArrayCS[1] = col0,col1
    fmt.Printf("%s", "\nTotal")
    fmt.Printf("     %-18.2f     %-18.2f%-18.2f\n",colArrayCS[0],colArrayCS[1],grandTotalCS);

} //end func CSValueTable

func CSValueCalc(gradesArrayptr *int,expValueArrayptr *float64) float64  {
  y := float64(*gradesArrayptr) - *expValueArrayptr
  z := (y * y) / *expValueArrayptr
  return z
}

func printHeaders()  {
  fmt.Printf("%s       %s     %18s%18s", "Grade","Male","Female","Total")
}

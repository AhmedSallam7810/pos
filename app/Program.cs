using System;

public class HelloWorld
{
    public static void Main(string[] args)
    {
        List<int> a= new List<int>();
        for(int i=0;i<5;i++){
            a.Add(Convert.ToInt16(Console.ReadLine()));
        }
        for(int i=0;i<5;i++){
        Console.WriteLine(a[i]+" hellloo ahmed ");
        }
        
    }
}
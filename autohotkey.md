### AutoHotKey笔记
- [字符串拼接](https://segmentfault.com/a/1190000005069285) var := var1 var2 ;直接空格隔开即可
- [= 和 ：的区别](http://www.jianshu.com/p/2575a3b1o_O6), 简单来说即：=后面全部当作字符串，如果要用变量的话，应该用 %var%的形式。:= 后面都视为变量
- ahk中常见的键盘编码 见手册hotkeys
```
Send {Lshift DOWN}
Send {Left}
Send {Lshift UP}
send, ^x
cont = %clipboard%
clipboard =
```
ifeq ($(make_basedir), ) 
	make_basedir := 
endif

CXXFLAGS := -g  -std=c++11
#INCLUDE := -I. 
#INCLUDE += -I$(make_basedir) lib
#INCLUDE += -I$(make_basedir) include
#INCLUDE += -I$(make_basedir) lib/libevent/include
#INCLUDE += -I$(make_basedir) lib/a/include
#INCLUDE += -I$(make_basedir) lib/mysql/include
#INCLUDE += -I$(make_basedir) lib/pugixml

#LIBDIR := -L. 
#LIBDIR += -L$(make_basedir) lib
#LIBDIR += -L$(make_basedir) lib/libevent/lib 
#LIBDIR += -L$(make_basedir) lib/mysql 
#LIBDIR += -L$(make_basedir) lib/json
#LIBDIR += -L/usr/lib64 


#LIB := -levent -lpthread -lmysqlclient -ljsoncpp   

.cpp.o:
	g++ $(CXXFLAGS) $(INCLUDE) -Wno-deprecated -c -o $@ $< 
 
src := main.cpp
#src += http_server.cpp
#src += serve.cpp
#src += database.cpp
#src += ./lib/pugixml/pugixml.cpp
#src += $(make_basedir)/conf/config.cpp
#src += $(make_basedir)/log.cpp

obj := $(src:.cpp=.o) 

run:all
	./main

all : $(obj)   
	g++  -g -o  main $(CXXFLAGS) $(INCLUDE) $(obj) $(LIBDIR) $(LIB)  -Wl,-rpath,  -fPIC
 
clean: $(obj)
	rm -f *.o
	rm -f main

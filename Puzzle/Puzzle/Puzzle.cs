using Microsoft.AspNet.SignalR;
using Microsoft.AspNet.SignalR.Hubs;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Puzzle.Puzzle
{
    [HubName("moveShape")]
    public class Puzzle : Hub
    {
        public void moveShape(double x, double y)
        {
            Clients.Others.shapeMoved(x, y);
        }
    }
}